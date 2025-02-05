<?php
namespace Clicalmani\Cookie;

class Cookie
{
    /**
     * Cookie constructor
     * 
     * @param string $name
     * @param string $value
     * @param int $expires
     * @param string $path
     * @param string $domain
     * @param bool $secure
     * @param bool $httpOnly
     */
    public function __construct(
        protected string $name,
        protected string $value,
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
     * @return void
     */
    public function set(): void
    {
        setcookie(
            $this->name,
            $this->value,
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
     * @return string
     */
    public function get(): string
    {
        return $_COOKIE[$this->name];
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
     * @return bool
     */
    public function exists(): bool
    {
        return isset($_COOKIE[$this->name]);
    }

    /**
     * Get cookie name
     * 
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get cookie value
     * 
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * Get cookie expires
     * 
     * @return int
     */
    public function getExpires(): int
    {
        return $this->expires;
    }

    /**
     * Get cookie path
     * 
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * Get cookie domain
     * 
     * @return string
     */
    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * Get cookie secure
     * 
     * @return bool
     */
    public function getSecure(): bool
    {
        return $this->secure;
    }

    /**
     * Get cookie httpOnly
     * 
     * @return bool
     */
    public function getHttpOnly(): bool
    {
        return $this->httpOnly;
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

    /**
     * Get all cookies
     * 
     * @return array
     */
    public function allEntries(): array
    {
        return array_map(fn($key, $value) => [$key => $value], array_keys($_COOKIE), array_values($_COOKIE));
    }

    /**
     * Get all cookies
     * 
     * @return array
     */
    public function allEntriesKeys(): array
    {
        return array_map(fn($key, $value) => $key, array_keys($_COOKIE), array_values($_COOKIE));
    }

    /**
     * Get all cookies
     * 
     * @return array
     */
    public function allEntriesValues(): array
    {
        return array_map(fn($key, $value) => $value, array_keys($_COOKIE), array_values($_COOKIE));
    }
}