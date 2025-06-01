<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpMqtt\Client\Facades\MQTT;
use App\Models\TrashBin;
use App\Models\Notification;

class MqttSubscribe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:mqtt-subscribe {topic}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $topic = $this->argument('topic');

        $mqtt = MQTT::connection();

        $this->info("Subscribing to topic: {$topic}");

        $mqtt->subscribe($topic, function (string $topic, string $message) {
            $this->info(sprintf("Received message on topic [%s]: %s", $topic, $message));

            // Assuming the message is a JSON string containing trash bin data
            $data = json_decode($message, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                $this->error("Failed to decode JSON message: " . json_last_error_msg());
                return;
            }

            // Extract relevant data from the MQTT message
            $binId = $data['bin_id'] ?? null;
            $capacityPercentage = $data['capacity_percentage'] ?? null;
            $isFull = $data['is_full'] ?? false;

            if (!$binId) {
                $this->error("MQTT message missing 'bin_id'.");
                return;
            }

            $trashBin = TrashBin::where('bin_id', $binId)->first();

            if (!$trashBin) {
                $this->error("Trash bin with ID {$binId} not found.");
                return;
            }

            // Create a notification if the bin is full
            if ($isFull) {
                Notification::create([
                    'trash_bin_id' => $trashBin->id,
                    'message' => "Trash bin '{$trashBin->name}' at '{$trashBin->location}' is full!",
                    'type' => 'full_bin',
                    'read' => false,
                ]);
                $this->info("Notification created for full trash bin: {$trashBin->name}");
            }

            // You might also want to store TrashData here if not already handled by TrashBinController
            // For example:
            // TrashData::create([
            //     'trash_bin_id' => $trashBin->id,
            //     'capacity_percentage' => $capacityPercentage,
            //     'weight' => $data['weight'] ?? null,
            //     'is_full' => $isFull,
            // ]);

        });

        $mqtt->loop(true);
    }
}
