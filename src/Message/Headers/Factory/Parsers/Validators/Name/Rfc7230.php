<?php

namespace Thisisboris\Psr7\Message\Headers\Factory\Parsers\Validators\Name;

/**
 * @see https://datatracker.ietf.org/doc/html/rfc7230 Hypertext Transfer Protocol (HTTP/1.1): Message Syntax and Routing
 * For https://datatracker.ietf.org/doc/html/rfc7230#section-3.2.6 (https://datatracker.ietf.org/doc/html/rfc7230#appendix-B)
 * TOKEN is ! # $ % & ' * + - . ^ _ ` | ~  DIGIT ALPHA and VCHAR, except delimiters.
 * Delimiters are defined as DQUOTE ( ) , / : ; < = > ? @ [ \ ] { } (This corresponds with SEPARATORS in RFC 2616)
 * DIGIT is any decimal 0-9
 * ALPHA is %x41-5A / %x61-7A   ; A-Z / a-z
 * VCHAR is %x21-7E ; visible (printing) characters
 */
class Rfc7230
{






}