<?php
/**
 * Created by PhpStorm.
 * User: Kalana
 * Date: 29/03/2019
 * Time: 9:05 AM
 */

namespace App\Helpers\Logger;
use Monolog\Logger;
use App\Helpers\Logger\ChannelStreamHandler;
class ChannelWriter
{
    protected  $date;
    /**
     * The Log channels.
     *
     * @var array
     */
    protected $channels = [
        'audit' => [
            'path' => 'logs/custom_logs/audit',
            'level' => Logger::INFO
        ],'exception' => [
            'path' => 'logs/custom_logs/exception',
            'level' => Logger::INFO
        ],'debug' => [
            'path' => 'logs/custom_logs/debug',
            'level' => Logger::DEBUG
        ],
        'notice' => [
            'path' => 'logs/custom_logs/notice',
            'level' => Logger::NOTICE
        ],'info' => [
            'path' => 'logs/custom_logs/info',
            'level' => Logger::INFO
        ]
    ];

    /**
     * The Log levels.
     *
     * @var array
     */
    protected $levels = [
        'debug'     => Logger::DEBUG,
        'info'      => Logger::INFO,
        'notice'    => Logger::NOTICE,
        'warning'   => Logger::WARNING,
        'error'     => Logger::ERROR,
        'critical'  => Logger::CRITICAL,
        'alert'     => Logger::ALERT,
        'emergency' => Logger::EMERGENCY,
    ];

    public function __construct() {
        $this->date = date('Y-m-d');
    }

    /**
     * Write to log based on the given channel and log level set
     *
     * @param type $channel
     * @param type $message
     * @param array $context
     * @throws InvalidArgumentException
     */
    public function writeLog($channel, $level, $message, array $context = [])
    {
        //check channel exist
        if( !in_array($channel, array_keys($this->channels)) ){
            throw new InvalidArgumentException('Invalid channel used.');
        }

        //lazy load logger
        if( !isset($this->channels[$channel]['_instance']) ){
            //create instance
            $this->channels[$channel]['_instance'] = new Logger($channel);
            //add custom handler
            $this->channels[$channel]['_instance']->pushHandler(
                new ChannelStreamHandler(
                    $channel,
                    storage_path() .'/'. $this->channels[$channel]['path'].'_'.str_replace(' ','-',$this->date).'.log',
                    $this->channels[$channel]['level']
                )
            );
        }

        //write out record
        $this->channels[$channel]['_instance']->{$level}($message, $context);
    }

    public function write($channel, $message, array $context = []){
        //get method name for the associated level
        $level = array_flip( $this->levels )[$this->channels[$channel]['level']];
        //write to log
        $this->writeLog($channel, $level, $message, $context);
    }

    //alert('event','Message');
    function __call($func, $params){
        if(in_array($func, array_keys($this->levels))){
            return $this->writeLog($params[0], $func, $params[1]);
        }
    }
}
