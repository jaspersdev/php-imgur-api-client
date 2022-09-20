<?php
declare( strict_types=1 );

namespace Imgur\DTO;

final class RateLimits {

  private int $clientLimit;

  private int $clientRemaining;

  private int $userLimit;

  private int $userRemaining;

  private int $userReset;

  public static function fromHeaders( array $headers ): RateLimits {
    return new self(
      $headers[ 'x-ratelimit-clientlimit' ] ? (int) $headers[ 'x-ratelimit-clientlimit' ][ 0 ] : null,
      $headers[ 'x-ratelimit-clientremaining' ] ? (int) $headers[ 'x-ratelimit-clientremaining' ][ 0 ] : null,
      $headers[ 'x-ratelimit-userlimit' ] ? (int) $headers[ 'x-ratelimit-userlimit' ][ 0 ] : null,
      $headers[ 'x-ratelimit-userremaining' ] ? (int) $headers[ 'x-ratelimit-userremaining' ][ 0 ] : null,
      $headers[ 'x-ratelimit-userreset' ] ? (int) $headers[ 'x-ratelimit-userreset' ][ 0 ] : null,
    );
  }

  public function getClientLimit(): int {
    return $this->clientLimit;
  }

  public function getClientRemaining(): int {
    return $this->clientRemaining;
  }

  public function getUserLimit(): int {
    return $this->userLimit;
  }

  public function getUserRemaining(): int {
    return $this->userRemaining;
  }

  public function getUserReset(): int {
    return $this->userReset;
  }

  public function toArray(): array {
    return [
      'X-ClientLimit' => $this->clientLimit,
      'X-ClientRemaining' => $this->clientRemaining,
      'X-UserLimit' => $this->userLimit,
      'X-UserRemaining' => $this->userRemaining,
      'X-UserReset' => $this->userReset,
    ];
  }

  private function __construct( int $clientLimit, int $clientRemaining, int $userLimit, int $userRemaining, int $userReset ) {
    $this->clientLimit = $clientLimit;
    $this->clientRemaining = $clientRemaining;
    $this->userLimit = $userLimit;
    $this->userRemaining = $userRemaining;
    $this->userReset = $userReset;
  }
}