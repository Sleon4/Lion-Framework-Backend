<?php

namespace App\Enums\Framework;

enum StatusEnum: string {

    case SUCCESS = "success";
    case ERROR = "error";
    case WARNING = "warning";
    case INFO = "info";
    case DATABASE_ERROR = "database-error";
    case SESSION_ERROR = "session-error";
    case ROUTE_ERROR = "route-error";

    public static function values(): array {
        return array_map(fn($value) => $value->value, self::cases());
    }

}
