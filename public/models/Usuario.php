<?php
require_once("Evento.php");

class Usuario
{
    private string $nick;
    private string $nombre;
    private string $apellidos;
    private string $correo;
    private int $karma;
    //Array de eventos a los que asiste
    private array $eventos_asistidos;

    public function getNick(): string
    {
        return $this->nick;
    }

    public function setNick(string $nick): void
    {
        $this->nick = $nick;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getApellidos(): string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): void
    {
        $this->apellidos = $apellidos;
    }

    public function getCorreo(): string
    {
        return $this->correo;
    }

    public function setCorreo(string $correo): void
    {
        $this->correo = $correo;
    }

    public function getKarma(): int
    {
        return $this->karma;
    }

    public function setKarma(int $karma): void
    {
        $this->karma = $karma;
    }

    public function getEventosAsistidos(): array
    {
        return $this->eventos_asistidos;
    }

    public function setEventosAsistidos(array $eventos_asistidos): void
    {
        $this->eventos_asistidos = $eventos_asistidos;
    }
}
?>