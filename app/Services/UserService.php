<?php

namespace App\Services;

use App\Repositories\SwarmRepository;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UserService
{
    protected $userRepository;
    protected $swarmRepository;

    public function __construct(UserRepository $userRepository, SwarmRepository $swarmRepository)
    {
        $this->userRepository = $userRepository;
        $this->swarmRepository = $swarmRepository;
    }

    public function register(array $data): array
    {
        $data['btag'] = Str::random(8);
        $this->swarmRepository->requestSession();

        $this->swarmRepository->validateRecaptcha($data);

        $registrationResponse = $this->swarmRepository->registerUserWithSwarm($data);

        $data['swarm_uid'] = $registrationResponse['data']['details']['uid'];
        $this->userRepository->create($data);

        $jweToken = $registrationResponse['data']['details']['jwe_token'];
        $loginResponse = $this->swarmRepository->loginViaJWEToken(['jwe_token' => $jweToken]);

        return [
            'auth_token' => $loginResponse['data']['auth_token'],
            'user_id' => $loginResponse['data']['user_id'],
            'jwe_token' => $jweToken,
        ];
    }
}
