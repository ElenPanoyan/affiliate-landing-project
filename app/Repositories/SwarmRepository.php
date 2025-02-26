<?php

namespace App\Repositories;

use WebSocket\Client;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SwarmRepository
{
    protected $client;
    protected $sessionId;

    public function __construct()
    {
        $this->client = new Client(config('app.swarm.websocket_endpoint'));
    }

    /**
     * Send a command via WebSocket
     */
    protected function sendCommand(array $command): array
    {
        $this->client->send(json_encode($command));
        $response = json_decode($this->client->receive(), true);
        Log::info('WebSocket response', ['command' => $command, 'response' => $response]);
        return $response;
    }

    /**
     * Request a session
     */
    public function requestSession(): string
    {
        $command = [
            'command' => 'request_session',
            'params' => [
                'site_id' => config('app.swarm.site_id'),
                'language' => config('app.swarm.language'),
            ],
        ];
        $response = $this->sendCommand($command);
        if (!isset($response['data']['sid'])) {
            Log::error('Session request failed', ['response' => $response]);
            throw new Exception('Failed to request Swarm session');
        }
        $this->sessionId = $response['data']['sid'];
        return $this->sessionId;
    }

    /**
     * Validate reCAPTCHA
     */
    public function validateRecaptcha($data)
    {
        $command = [
            'command' => 'validate_recaptcha',
            'params' => [
                'action' => 'register',
                'g_recaptcha_response' => $data['g-recaptcha-response'],
                'version' => 'v2', //with v3 -> code 27 response from the Swarm API(low score for the user)
            ],
        ];

        $response = $this->sendCommand($command);
        if (!isset($response['code']) || $response['code'] !== 0) {
            Log::error('Recaptcha validation failed', ['response' => $response]);
            throw new Exception('Recaptcha validation failed');
        }
    }

    /**
     * Register a user via Swarm API
     */
    public function registerUserWithSwarm(array $data)
    {
        $command = [
            'command' => 'register_user',
            'params' => [
                'user_info' => [
                    'username' => $data['username'] ?? $data['email'],
                    'password' => $data['password'],
                    'lang_code' => config('app.swarm.language'),
                    'country_code' => $data['country_code'],
                    'email' => $data['email'],
                    'phone' => $data['phone_number'],
                    'currency_name' => $data['currency_code'],
                    'btag' => $data['btag'],
                    'g_recaptcha_response' => $data['g-recaptcha-response'],
                ],
            ],
        ];
        $response = $this->sendCommand($command);

        if (!isset($response['code']) || $response['code'] !== 0 || !isset($response['data']['details']['jwe_token'])) {
            Log::error('Swarm registration failed', ['response' => $response]);
            throw new Exception('Swarm registration failed');
        }
        return $response;
    }

    /**
     * Login via jwe_token
     */
    public function loginViaJWEToken(array $data)
    {
        $command = [
            'command' => 'login_encrypted',
            'params' => [
                'jwe_token' => $data['jwe_token'],
            ],
        ];
        $response = $this->sendCommand($command);

        if (!isset($response['code']) || $response['code'] !== 0 || !isset($response['data'])) {
            Log::error('Swarm login failed', ['response' => $response]);
            throw new Exception('Swarm login failed');
        }
        return $response;
    }
}
