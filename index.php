<?php

declare(strict_types=1);

interface NotificationChannelInterface
{
    public function kirim(string $tujuan, string $pesan): bool;
}

class EmailChannel implements NotificationChannelInterface
{
    public function kirim(string $tujuan, string $pesan): bool
    {
        echo "[EMAIL] Mengirim ke {$tujuan}: \"{$pesan}\"\n";
        return true;
    }
}

class WhatsAppChannel implements NotificationChannelInterface
{
    public function kirim(string $tujuan, string $pesan): bool
    {
        echo "[WHATSAPP] Mengirim ke {$tujuan}: \"{$pesan}\"\n";
        return true;
    }
}

class SmsChannel implements NotificationChannelInterface
{
    public function kirim(string $tujuan, string $pesan): bool
    {
        echo "[SMS] Mengirim ke {$tujuan}: \"{$pesan}\"\n";
        return true;
    }
}

class NotificationService
{
    private NotificationChannelInterface $channel;

    public function __construct(NotificationChannelInterface $channel)
    {
        $this->channel = $channel;
    }

    public function kirimPesan(string $tujuan, string $pesan): bool
    {
        return $this->channel->kirim($tujuan, $pesan);
    }
}

try {
    $emailService = new NotificationService(new EmailChannel());
    $emailService->kirimPesan('user@example.com', 'Halo, ini notifikasi via Email.');

    $waService = new NotificationService(new WhatsAppChannel());
    $waService->kirimPesan('081234567890', 'Halo, ini notifikasi via WhatsApp.');

    $smsService = new NotificationService(new SmsChannel());
    $smsService->kirimPesan('081234567890', 'Halo, ini notifikasi via SMS.');
} catch (\Throwable $e) {
    echo "Terjadi kesalahan: " . $e->getMessage() . "\n";
}
