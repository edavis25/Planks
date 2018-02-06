<?php

namespace App\Helpers;
use Request;
/**
 * Helper for building flash messages using Bootstrap 4 alerts
 * and the "partials/alert.blade.php" view
 *
 */

class FlashMessage
{
    public static function create_alert_by_type($message, $status = 'info', $additionalDetails = null) {
        Request::session()->flash('flash_message', $message);
        Request::session()->flash('flash_status', $status);

        if ($additionalDetails) {
            Request::session()->flash('flash_details', $additionalDetails);
        }
    }

    /**
     * Helper functions by alert type
     */
    public static function success($message, $additionalDetails = null) {
        self::create_alert_by_type($message, 'success', $additionalDetails);
    }

    public static function warning($message, $additionalDetails = null) {
        self::create_alert_by_type($message, 'warning', $additionalDetails);
    }

    public static function danger($message, $additionalDetails = null) {
        self::create_alert_by_type($message, 'danger', $additionalDetails);
    }

    public static function info($message, $additionalDetails = null) {
        self::create_alert_by_type($message, 'info', $additionalDetails);
    }
}
