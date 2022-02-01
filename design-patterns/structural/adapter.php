<?php

declare(strict_types=1);

/**
 * Adapter pattern works as a bridge between two incompatible interfaces.
 * Adapter is single class which is responsible to join functionalities of
 * independent interfaces. It translate the interface of one class to the
 * interface to another and with this protect the client code from changing.
 */

interface MediaPlayer
{
    public function play(string $audioType, string $fileName) : void;
}

interface AdvancedMediaPlayer
{
    public function playMusic(string $fileName): void;
}

class VlcPlayer implements AdvancedMediaPlayer
{
    public function playMusic(string $fileName): void
    {
        echo 'Playing vlc file. Name: ' . $fileName;
    }
}

class Mp4Player implements AdvancedMediaPlayer
{
    public function playMusic(string $fileName): void
    {
        echo 'Playing mp4 file. Name: ' . $fileName;
    }
}

class MediaAdapter implements MediaPlayer
{
    public AdvancedMediaPlayer $advancedMusicPlayer;

    public function __construct(string $audioType)
    {
        if($audioType == 'vlc') {
            $this->advancedMusicPlayer = new VlcPlayer();
        } elseif($audioType == 'mp4') {
            $this->advancedMusicPlayer = new Mp4Player();
        }
    }

    public function play(string $audioType, string $fileName): void
    {
        $this->advancedMusicPlayer->playMusic($fileName);
    }
}

class AudioPlayer implements MediaPlayer
{
    public MediaAdapter $mediaAdapter;

    public function play(string $audioType, string $fileName): void
    {
        if($audioType == 'mp3') {
            echo 'Playing mp3 file. Name: ' . $fileName;
        } elseif($audioType == 'vlc' || $audioType == 'mp4') {
            $this->mediaAdapter = new MediaAdapter($audioType);
            $this->mediaAdapter->play($audioType, $fileName);
        } else {
            echo 'Invalid media. ' . $audioType . ' format not supported';
        }
    }
}

class DemoAdapterPattern
{
    public function __construct()
    {
        echo 'ADAPTER DESIGN PATTERN' . '<br/><br/>';

        $audioPlayer = new AudioPlayer();

        $audioPlayer->play('mp3', 'beyond the horizon.mp3');
        echo '<br>';
        $audioPlayer->play('mp4', 'alone.mp4');
        echo '<br>';
        $audioPlayer->play('vlc', 'far far away.vlc');
        echo '<br>';
        $audioPlayer->play('avi', 'mid me.avi');
    }
}

$demoAdapterPattern = new DemoAdapterPattern();
