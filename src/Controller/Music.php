<?php

namespace App\Controller;

use Exception;
use Madcoda\Youtube;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class Music
 *
 * @package App\Controller
 */
class Music extends AbstractController
{
    private const YOUTUBE_KEY = 'xx';
    private const YOUTUBE_CHANNEL_ID = 'UCX06sx2WWYGny7b3XDUyFCQ';

    /**
     * @var Youtube
     */
    private $youtube;

    /**
     * Music constructor.
     */
    public function __construct()
    {
        try {
            $this->youtube = new Youtube(['key' => self::YOUTUBE_KEY]);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Homepage.
     *
     * @Route("/", name="homepage")
     */
    public function homepage(): Response
    {
        try {
            $playlist = $this->youtube->getPlaylistsByChannelId(self::YOUTUBE_CHANNEL_ID);
            $error = '';
        } catch (Exception $e) {
            $error = $e->getMessage();
            $playlist = '';
        }

        return $this->render('base.html.twig', [
            'error'  => $error,
            'playlist' => $playlist,
        ]);
    }

    /**
     * Show playlist item.
     *
     * @Route("/{playlistId}", name="playlistItem")
     *
     * @param $playlistId
     *
     * @return Response
     */
    public function showPlaylistItem($playlistId): Response
    {
        try {
            $playlist = $this->youtube->getPlaylistsByChannelId(self::YOUTUBE_CHANNEL_ID);
            $video = $this->youtube->getPlaylistItemsByPlaylistId($playlistId);
            $error = '';
        } catch (Exception $e) {
            $error = $e->getMessage();
            $video = '';
            $playlist = '';
        }

        return $this->render('item.html.twig', [
            'videos' => $video,
            'error'  => $error,
            'playlist' => $playlist
        ]);
    }
}