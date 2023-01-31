<?php

namespace TomatoPHP\TomatoBackup\Models;

use Illuminate\Database\Eloquent\Model;
use TomatoPHP\TomatoBackup\Services\SpatieLaravelBackup;
use Sushi\Sushi;

class BackupDestinationStatus extends Model
{
    use Sushi;

    protected array $rows;

    public function getRows(): array
    {
        $this->rows = SpatieLaravelBackup::getBackupDestinationStatusData();
        return  $this->rows;
    }
}
