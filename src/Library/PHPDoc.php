<?php

namespace krzysztofzylka\SimpleLibraries\Library;

use Exception;
use krzysztofzylka\SimpleLibraries\Exception\SimpleLibraryException;
use ReflectionClass;

/**
 * PHP Docs
 */
class PHPDoc {

    /**
     * Get comment from class
     * @param string $class
     * @param string|null $type
     * @return array
     * @throws SimpleLibraryException
     */
    public static function getClassComment(string $class, ?string $type = null) : array {
        try {
            $reflector = new ReflectionClass($class);
            $comment = $reflector->getDocComment();
            $explodeComment = explode(PHP_EOL, $comment);
            $comments = self::cleanComment($explodeComment);
        } catch (Exception $e) {
            throw new SimpleLibraryException('Fail reading class comment');
        }

        if (!is_null($type)) {
            $return = [];

            foreach ($comments as $commentValue) {
                if ($commentValue[0] === $type) {
                    $return[] = $commentValue[1];
                }
            }

            return $return;
        } else {
            return $comments;
        }
    }

    /**
     * Get comments from class methods
     * @param string $class Class name
     * @param string $method Method name
     * @param ?string $type comment name without @ (example: for @return write return)
     * @return array [[key, value], [key, value]], if type is not null [key, value]
     * @throws SimpleLibraryException
     */
    public static function getClassMethodComment(string $class, string $method, ?string $type = null) : array {
        try {
            $reflector = new ReflectionClass($class);
            $comment = $reflector->getMethod($method)->getDocComment();
            $explodeComment = explode(PHP_EOL, $comment);
            $comments = self::cleanComment($explodeComment);
        } catch (Exception $e) {
            throw new SimpleLibraryException('Error comment reading');
        }

        if (!is_null($type)) {
            $return = [];

            foreach ($comments as $commentValue) {
                if ($commentValue[0] === $type) {
                    $return[] = $commentValue[1];
                }
            }

            return $return;
        } else {
            return $comments;
        }
    }

    /**
     * Search in commend with name and value
     * @param array $comments comments list from getClassMethodComment
     * @param string $name comment name without @ (example: for @return write return)
     * @param ?string $value comment value (default null)
     * @return array|bool array if $value is null
     */
    public static function findClassMethodComment(array $comments, string $name, ?string $value = null) : array|bool {
        $return = [];

        foreach ($comments as $commentValue) {
            if ($commentValue[0] === $name) {
                $return[] = $commentValue[1];
            }
        }

        if (!is_null($value)) {
            return in_array($value, $return);
        }

        return $return;
    }

    /**
     * Clear comment
     * @param array $comments PHPDocs data example ['/*', '* value']
     * @return array data as [key, value] (example [return, void])
     */
    private static function cleanComment(array $comments) : array {
        $cleanComment = [];

        foreach ($comments as $comment) {
            $comment = trim($comment);

            if ($comment === '*/' || $comment === '/**') {
                continue;
            }

            if (str_starts_with($comment, '* ')) {
                $comment = substr($comment, 2);
            }

            if (str_starts_with($comment, '@')) {
                $explodeComment = explode(' ', $comment, 2);
                $cleanComment[] = [str_replace('@', '', $explodeComment[0]), $explodeComment[1]];

                continue;
            }

            $cleanComment[] = ['', $comment];
        }

        return $cleanComment;
    }

}