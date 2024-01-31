<?php
require_once("Usuario.php");

class Evento
{
    private int $id;
    private string $nombre;
    private string $ubicacion;
    private string $tipo_terreno;
    private DateTime $fecha;
    private string $tipo_evento;
    private Usuario $anfitrion;
    private string $imagen;
    //Array de usuarios
    private array $asistentes;
    //Array asociativo de especies plantadas junto a su cantidad
    private array $plantadas;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getUbicacion(): string
    {
        return $this->ubicacion;
    }

    public function setUbicacion(string $ubicacion): void
    {
        $this->ubicacion = $ubicacion;
    }

    public function getTipoTerreno(): string
    {
        return $this->tipo_terreno;
    }

    public function setTipoTerreno(string $tipo_terreno): void
    {
        $this->tipo_terreno = $tipo_terreno;
    }

    public function getFecha(): DateTime
    {
        return $this->fecha;
    }

    public function setFecha(DateTime $fecha): void
    {
        $this->fecha = $fecha;
    }

    public function getTipoEvento(): string
    {
        return $this->tipo_evento;
    }

    public function setTipoEvento(string $tipo_evento): void
    {
        $this->tipo_evento = $tipo_evento;
    }

    public function getAnfitrion(): Usuario
    {
        return $this->anfitrion;
    }

    public function setAnfitrion(Usuario $anfitrion): void
    {
        $this->anfitrion = $anfitrion;
    }

    public function getImagen(): string
    {
        return $this->imagen;
    }

    public function setImagen(string $imagen): void
    {
        $this->imagen = $imagen;
    }

    public function getAsistentes(): array
    {
        return $this->asistentes;
    }

    public function setAsistentes(array $asistentes): void
    {
        $this->asistentes = $asistentes;
    }

    public function getPlantadas(): array
    {
        return $this->plantadas;
    }

    public function setPlantadas(array $plantadas): void
    {
        $this->plantadas = $plantadas;
    }
}
?>