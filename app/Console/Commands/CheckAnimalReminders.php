<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\animal;
use Carbon\Carbon;

class CheckAnimalReminders extends Command
{
    protected  $signature = 'reminders:check';
    protected $description = 'Check animals and send appointment reminders';

    public function handle()
    {
        $animals = animal::all();
        $now = Carbon::now();
        foreach ($animals as $animal)
        {
            $type = $animal->animal_type;
            $defaultDays = match($type){
                'قطة' => 30,
                'كلب' => 45,
                'أرنب' => 20,
                'طائر' => 60,
                default => 30,

            };
            // حدد إن كان الموعد موجود
            if ($animal->clinic_appointment) {
                $daysLeft = $now->diffInDays(Carbon::parse($animal->clinic_appointment), false);
                if ($daysLeft <= 1) {
                    $this->sendReminder($animal, 'اقترب موعد زيارة العيادة 🐾');
                }
            } else {
                // موعد غير محدد → تذكير تلقائي
                $lastReminder = $animal->last_reminder_sent
                    ? Carbon::parse($animal->last_reminder_sent)
                    : null;

                if (!$lastReminder || $now->diffInDays($lastReminder) >= $defaultDays) {
                    $this->sendReminder($animal, 'مر وقت طويل على آخر زيارة، تأكد من صحة حيوانك 🐶');
                }
            }
        }
    }

    private function sendReminder($animal, $message)
    {
        // هون ترسل إشعار، أو تبعت لـ Firebase أو Telegram أو Email...
        \Log::info("Reminder for animal {$animal->name}: $message");

        $animal->last_reminder_sent = now();
        $animal->save();
    }

}

