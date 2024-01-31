<?php
require_once("Evento.php");

class Especie
{
    private string $nombre;
    private string $clima;
    private string $region;
    private string $tiempo_crecimiento;
    private string $beneficios;
    private string $imagen;
    private string $enlace_wikipedia;
    //Array asociativo de eventos en los que se planta junto a su cantidad
    private array $eventos_plantada;

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getClima(): string
    {
        return $this->clima;
    }

    public function setClima(string $clima): void
    {
        $this->clima = $clima;
    }

    public function getRegion(): string
    {
        return $this->region;
    }

    public function setRegion(string $region): void
    {
        $this->region = $region;
    }

    public function getTiempoCrecimiento(): string
    {
        return $this->tiempo_crecimiento;
    }

    public function setTiempoCrecimiento(string $tiempo_crecimiento): void
    {
        $this->tiempo_crecimiento = $tiempo_crecimiento;
    }

    public function getBeneficios(): string
    {
        return $this->beneficios;
    }

    public function setBeneficios(string $beneficios): void
    {
        $this->beneficios = $beneficios;
    }

    public function getImagen(): string
    {
        return $this->imagen;
    }

    public function setImagen(string $imagen): void
    {
        $this->imagen = $imagen;
    }

    public function getEnlaceWikipedia(): string
    {
        return $this->enlace_wikipedia;
    }

    public function setEnlaceWikipedia(string $enlace_wikipedia): void
    {
        $this->enlace_wikipedia = $enlace_wikipedia;
    }

    public function getEventosPlantada(): array
    {
        return $this->eventos_plantada;
    }

    public function setEventosPlantada(array $eventos_plantada): void
    {
        $this->eventos_plantada = $eventos_plantada;
    }
}
?>