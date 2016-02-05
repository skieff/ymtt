<?php

namespace  AppBundle\Util;

use Yandex\Metrica\Management\ManagementClient;
use Yandex\Metrica\Management\Models\CounterItem;
use Yandex\Metrica\Management\Models\CountersParams;

class ApiWrapper {
    /**
     * @var ManagementClient
     */
    private $client;

    /**
     * @var string
     */
    private $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function getCounterList() {
        $client = $this->getClient();

        $counters = $client
            ->counters()
            ->getCounters(new CountersParams())
            ->getCounters();

        $result = [];

        foreach ($counters as $counter) {
            /** @var CounterItem $counter */
            $result[$counter->getId()] = $counter->getName();
        }

        return $result;
    }

    public function addGoals($counterId, $goals) {
        foreach ($goals as $goal) {
            $this->getClient()->goals()->addGoal($counterId, $goal);
        }
    }

    /**
     * @return ManagementClient
     */
    protected function getClient()
    {
        if (empty($this->client)) {
            $this->client = new ManagementClient($this->token);
        }

        return $this->client;
    }
}