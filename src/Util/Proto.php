<?php

declare(strict_types=1);

namespace Routr\SDK\Util;

class Proto
{
    /**
     * Convert an array to a protobuf message object.
     *
     * @param  class-string        $messageFqn The fully-qualified class name of the protobuf message.
     * @param  array<string,mixed> $data       The data to convert.
     * @return object The protobuf message object.
     * @throws \JsonException When JSON encoding fails.
     */
    public static function fromArray(string $messageFqn, array $data): object
    {
        $json = json_encode($data, JSON_THROW_ON_ERROR);
        $msg = new $messageFqn();
        if (method_exists($msg, 'mergeFromJsonString')) {
            $msg->mergeFromJsonString($json, true);
            return $msg;
        }
        // Fallback: attempt setters
        foreach ($data as $key => $value) {
            $setter = 'set' . str_replace(' ', '', ucwords(str_replace(['_', '-'], ' ', (string)$key)));
            if (method_exists($msg, $setter)) {
                $msg->{$setter}($value);
            }
        }
        return $msg;
    }

    /**
     * Convert a protobuf message object to an array.
     *
     * @param  object $message The protobuf message object.
     * @return array<string,mixed> The array representation of the message.
     */
    public static function toArray(object $message): array
    {
        if (method_exists($message, 'serializeToJsonString')) {
            $json = $message->serializeToJsonString();
            return json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        }
        return [];
    }
}
