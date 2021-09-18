<?php
/**
 * Created by PhpStorm.
 * User: Kalana
 * Date: 29/03/2019
 * Time: 9:06 AM
 */

namespace App\Helpers\Logger;

use Monolog\Handler\StreamHandler;
class ChannelStreamHandler extends StreamHandler
{
    /**
     * Channel name
     *
     * @var String
     */
    protected $channel;

    public function __construct($channel, $stream, $level = Logger::DEBUG, $bubble = true, $filePermission = null, $useLocking = false)
    {
        $this->channel = $channel;

        parent::__construct($stream, $level, $bubble);
    }

    /**
     * When to handle the log record.
     *
     * @param array $record
     * @return array $record
     */
    public function isHandling(array $record)
    {
        //Handle if Level high enough to be handled (default mechanism)
        //AND CHANNELS MATCHING!
        if( isset($record['channel']) ){
            return (
                $record['level'] >= $this->level &&
                $record['channel'] == $this->channel
            );
        } else {
            return (
                $record['level'] >= $this->level
            );
        }
    }
}