<?php

namespace Thisisboris\Psr7\Response;

/** @note Lifted from https://www.iana.org/assignments/http-status-codes/http-status-codes.xhtml */
enum Status : int
{
    case Continue = 100;

    case SwitchingProtocol = 101;

    case Processing = 102;

    case EarlyHints = 103;

    case OK = 200;

    case Created = 201;

    case Accepted = 202;

    case NonAuthoritativeInformation = 203;

    case NoContent = 204;

    case ResetContent = 205;

    case PartialContent = 206;

    case MultiStatus = 207;

    case AlreadyReported = 208;

    case IMUsed = 226;

    case MultipleChoice = 300;

    case MovedPermanently = 301;

    case Found = 302;

    case SeeOther = 303;

    case NotModified = 304;

    case UseProxy = 305;

    case TemporaryRedirect = 307;

    case PermanentRedirect = 308;

    case BadRequest = 400;

    case Unauthorized = 401;

    case PaymentRequired = 402;

    case Forbidden = 403;

    case NotFound = 404;

    case MethodNotAllowed = 405;

    case NotAcceptable = 406;

    case ProxyAuthenticationRequired = 407;

    case RequestTimeout = 408;

    case Conflict = 409;

    case Gone = 410;

    case LengthRequired = 411;

    case PreconditionFailed = 412;

    case ContentTooLarge = 413;

    case URITooLong = 414;

    case UnsupportedMediaType = 415;

    case RangeNotSatisfiable = 416;

    case ExpectationFailed = 417;

    case MisdirectedRequest = 421;

    case UnprocessableEntity = 422;

    case Locked = 423;

    case FailedDependency = 424;

    case TooEarly = 425;

    case UpgradeRequired = 426;

    case PreconditionRequired = 428;

    case TooManyRequests = 429;

    case RequestHeaderFieldTooLarge = 431;

    case UnavailableForLegalReasons = 451;

    case InternalServerError = 500;

    case NotImplemented = 501;

    case BadGateway = 502;

    case ServiceUnavailable = 503;

    case GatewayTimeout = 504;

    case HttpVersionNotSupported = 505;

    case VariantAlsoNegotiated = 506;

    case InsufficientStorage = 507;

    case LoopDetected = 508;

    case NetworkAuthenticationRequired = 510;

    public function toReasonPhrase(): string
    {
        return match ($this) {
            self::Continue => 'Continue',
            self::SwitchingProtocol => 'Switching Protocol',
            self::Processing => 'Processing',
            self::EarlyHints => 'Early Hints',
            self::OK => 'OK',
            self::Created => 'Created',
            self::Accepted => 'Accepted',
            self::NonAuthoritativeInformation => 'Non Authoritative Information',
            self::NoContent => 'No Content',
            self::ResetContent => 'Reset Content',
            self::PartialContent => 'Partial Content',
            self::MultiStatus => 'Multi Status',
            self::AlreadyReported => 'Already Reported',
            self::IMUsed => 'IM Used',
            self::MultipleChoice => 'Multiple Choice',
            self::MovedPermanently => 'Moved Permanently',
            self::Found => 'Found',
            self::SeeOther => 'See Other',
            self::NotModified => 'Not Modified',
            self::UseProxy => 'Use Proxy',
            self::TemporaryRedirect => 'Temporary Redirect',
            self::PermanentRedirect => 'Permanent Redirect',
            self::BadRequest => 'Bad Request',
            self::Unauthorized => 'Unauthorized',
            self::PaymentRequired => 'Payment Required',
            self::Forbidden => 'Forbidden',
            self::NotFound => 'Not Found',
            self::MethodNotAllowed => 'Method Not Allowed',
            self::NotAcceptable => 'Not Acceptable',
            self::ProxyAuthenticationRequired => 'Proxy Authentication Required',
            self::RequestTimeout => 'Request Timeout',
            self::Conflict => 'Conflict',
            self::Gone => 'Gone',
            self::LengthRequired => 'Length Required',
            self::PreconditionFailed => 'Precondition Failed',
            self::ContentTooLarge => 'Content Too Large',
            self::URITooLong => 'URI Too Long',
            self::UnsupportedMediaType => 'Unsupported Media Type',
            self::RangeNotSatisfiable => 'Range Not Satisfiable',
            self::ExpectationFailed => 'Expectation Failed',
            self::MisdirectedRequest => 'Misdirected Request',
            self::UnprocessableEntity => 'Unprocessable Entity',
            self::Locked => 'Locked',
            self::FailedDependency => 'Failed Dependency',
            self::TooEarly => 'Too Early',
            self::UpgradeRequired => 'Upgrade Required',
            self::PreconditionRequired => 'Precondition Required',
            self::TooManyRequests => 'Too Many Requests',
            self::RequestHeaderFieldTooLarge => 'Request Header Field Too Large',
            self::UnavailableForLegalReasons => 'Unavailable For Legal Reasons',
            self::InternalServerError => 'Internal Server Error',
            self::NotImplemented => 'Not Implemented',
            self::BadGateway => 'Bad Gateway',
            self::ServiceUnavailable => 'Service Unavailable',
            self::GatewayTimeout => 'Gateway Timeout',
            self::HttpVersionNotSupported => 'Http Version Not Supported',
            self::VariantAlsoNegotiated => 'Variant Also Negotiated',
            self::InsufficientStorage => 'Insufficient Storage',
            self::LoopDetected => 'Loop Detected',
            self::NetworkAuthenticationRequired => 'Network Authentication Required',
        };
    }
}
