<?php

namespace App\Exports;

use App\Models\City;
use App\Models\TrackList;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Format;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class UsersExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithColumnFormatting
{

    use Importable;
    private $date;
    private $city;

    public function __construct(string|null $date, string $city)
    {
        $this->date = $date;
        $this->city = $city;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $query = TrackList::query()
            ->select('id', 'track_code', 'status', 'city');
        if ($this->date != null){
            $query->whereDate('to_client', $this->date);
        }
        if ($this->city != 'Выберите город'){
            $query->where('city', 'LIKE', $this->city);
        }

        $data = $query->with('user')->get();

        return $data;
    }

    /**
     * @param $data
     * @return array
     */
    public function map($data): array
    {
        return [
            $data->id,
            $data->track_code,
            $data->status,
            $data->city,
            $data->user->name ?? '',
            $data->user->login ?? '',
            $data->user->city ?? '',
        ];
    }
    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_NUMBER,
        ];
    }
    public function headings(): array
    {
        return [
            '#',
            'Трек код',
            'Статус',
            'Город',
            'Имя',
            'Телефон',
            'Город клиента',
        ];
    }
}
