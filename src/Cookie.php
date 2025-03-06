<?php
namespace Clicalmani\Cookie;

class Cookie
{
    /**
     * Cookie constructor
     * 
     * @param ?string $name
     * @param ?string $value
     * @param int $expires
     * @param string $path
     * @param string $domain
     * @param bool $secure
     * @param bool $httpOnly
     */
    public function __construct(
        protected ?string $name = null,
        protected ?string $value = null,
        protected int $expires = 0,
        protected string $path = '',
        protected string $domain = '',
        protected bool $secure = false,
        protected bool $httpOnly = false
    ) {
        $this->name = $name;
        $this->value = $value;
        $this->expires = $expires;
        $this->path = $path;
        $this->domain = $domain;
        $this->secure = $secure;
        $this->httpOnly = $httpOnly;
    }

    /**
     * Set cookie
     * 
     * @param ?string $name
     * @param ?string $value
     * @return void
     */
    public function set(?string $name = null, ?string $value = null): void
    {
        setcookie(
            $name ?: $this->name,
            $value ?: $this->value,
            $this->expires,
            $this->path,
            $this->domain,
            $this->secure,
            $this->httpOnly
        );
    }

    /**
     * Get cookie
     * 
     * @param ?string $name
     * @return string
     */
    public function get(?string $name = null): string
    {
        return $_COOKIE[$name ?: $this->name];
    }

    /**
     * Delete cookie
     * 
     * @return void
     */
    public function delete(): void
    {
        if ($this->exists()) {
            setcookie(
                $this->name,
                '',
                time() - 3600,
                $this->path,
                $this->domain,
                $this->secure,
                $this->httpOnly
            );
        }
    }

    /**
     * Check if cookie exists
     * 
     * @param ?string $name
     * @return bool
     */
    public function exists(?string $name = null): bool
    {
        return isset($_COOKIE[$name ?: $this->name]);
    }

    /**
     * Get all cookies
     * 
     * @return array
     */
    public function all(): array
    {
        return $_COOKIE;
    }

    /**
     * Get all cookies
     * 
     * @return array
     */
    public function allKeys(): array
    {
        return array_keys($_COOKIE);
    }

    /**
     * Get all cookies
     * 
     * @return array
     */
    public function allValues(): array
    {
        return array_values($_COOKIE);
    }

    public function __get($name)
    {
        return match ($name) {
            $this->name => $this->value,
            'expires' => $this->expires,
            'path' => $this->path,
            'domain' => $this->domain,
            'secure' => $this->secure,
            'httpOnly' => $this->httpOnly
        };
    }

    public function __set($name, $value)
    {
        match ($name) {
            $this->name => $this->value = $value,
            'expires' => $this->expires = $value,
            'path' => $this->path = $value,
            'domain' => $this->domain = $value,
            'secure' => $this->secure = $value,
            'httpOnly' => $this->httpOnly = $value
        };
    }
}