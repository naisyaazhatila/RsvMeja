<?php

namespace App\Exports;

use App\Models\Reservation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ReservationsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $dateFrom;
    protected $dateTo;
    protected $status;
    protected $paymentStatus;
    protected $sortBy;
    protected $sortOrder;

    public function __construct($dateFrom, $dateTo, $status = null, $paymentStatus = null, $sortBy = 'created_at', $sortOrder = 'desc')
    {
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
        $this->status = $status;
        $this->paymentStatus = $paymentStatus;
        $this->sortBy = $sortBy;
        $this->sortOrder = $sortOrder;
    }

    public function collection()
    {
        $query = Reservation::with('table')
            ->whereBetween('reservation_date', [$this->dateFrom, $this->dateTo]);

        if ($this->status) {
            $query->where('status', $this->status);
        }

        if ($this->paymentStatus) {
            $query->where('payment_status', $this->paymentStatus);
        }

        return $query->orderBy($this->sortBy, $this->sortOrder)->get();
    }

    public function headings(): array
    {
        return [
            'Kode Booking',
            'Nama Pelanggan',
            'Email',
            'Telepon',
            'Meja',
            'Tanggal Reservasi',
            'Waktu',
            'Jumlah Orang',
            'Status Reservasi',
            'Status Pembayaran',
            'Jumlah DP',
            'Permintaan Khusus',
            'Dibuat Pada',
        ];
    }

    public function map($reservation): array
    {
        $statusLabels = [
            'pending' => 'Pending',
            'confirmed' => 'Confirmed',
            'cancelled' => 'Cancelled',
            'completed' => 'Completed',
        ];

        $paymentLabels = [
            'unpaid' => 'Belum Bayar',
            'pending' => 'Pending Verifikasi',
            'paid' => 'Lunas',
        ];

        return [
            $reservation->booking_code,
            $reservation->customer_name,
            $reservation->customer_email,
            $reservation->customer_phone,
            $reservation->table->name ?? '-',
            $reservation->reservation_date->format('d/m/Y'),
            $reservation->reservation_time ? date('H:i', strtotime($reservation->reservation_time)) : '-',
            $reservation->number_of_people,
            $statusLabels[$reservation->status] ?? ucfirst($reservation->status),
            $paymentLabels[$reservation->payment_status] ?? ucfirst($reservation->payment_status),
            'Rp ' . number_format($reservation->dp_amount, 0, ',', '.'),
            $reservation->special_request ?? '-',
            $reservation->created_at->format('d/m/Y H:i'),
        ];
    }
}
