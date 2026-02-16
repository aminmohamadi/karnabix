<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\EpisodeRepositoryInterface;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class StorageController extends Controller
{
    private EpisodeRepositoryInterface $episodeRepository;

    public function __construct(EpisodeRepositoryInterface $episodeRepository)
    {
        $this->episodeRepository = $episodeRepository;
    }

    public function __invoke($episodeId, $type)
    {
        $episode = $this->episodeRepository->findOrFail($episodeId);
        $user = Auth::user();

        $hasAccess = $episode->free || $episode->course->price == 0 || $user->hasCourse($episode->course->id) || $user->hasPermissionTo('edit_courses');

        if (!$hasAccess) {
            abort(403, 'Unauthorized access');
        }
//        dd($this->getFile($episode->local_video, getDisk($episode->video_storage)));
        return match ($type) {

            'video' => $this->getFile($episode->local_video, getDisk($episode->video_storage)),
            'file' => $this->getFile($episode->file, getDisk($episode->file_storage)),
            default => $this->getFile(dirname($episode->local_video).'/'.$type, getDisk($episode->file_storage)),
        };
    }

    private function getFile($path , Filesystem $filesystem): \Illuminate\Http\Response
    {
        if (!$filesystem->exists($path))
            abort(404);

        $file = $filesystem->get($path);

        $type = $filesystem->mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }


}
