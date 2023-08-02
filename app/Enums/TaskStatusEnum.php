<?php
namespace App\Enums;

use BenSampo\Enum\Enum;

class TaskStatusEnum extends Enum
{
    const PENDING = 'PENDING';
    const STARTED = 'STARTED';
    const COMPLETED = 'COMPLETED';

    /**
     * @param  mixed  $value
     * @return string
     */
    public static function getDescription($value): string
    {
        switch ($value) {
            case self::PENDING:
                return 'Pending';

            case self::STARTED:
                return 'Started';

            case self::COMPLETED:
                return 'Completed';

            default:
                return '';
        }
    }
}
