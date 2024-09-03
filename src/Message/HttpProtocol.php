<?php

namespace Thisisboris\Psr7\Message;

enum HttpProtocol : string
{
    case OneDotZero = '1.0';
    case OneDotOne = '1.1';
    case TwoDotZero = '2.0';
}
