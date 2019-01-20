<?php

namespace App\Http\Controllers;

use App\Entities\Click;
use App\Interfaces\BadDomain\BadDomainRepositoryInterface;
use App\Interfaces\Click\ClickRepositoryInterface;
use App\Interfaces\Uuid\UuidGeneratorInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;


/**
 * Class Controller
 * @package App\Http\Controllers
 */
class Controller extends BaseController
{
    /**
     * @var ClickRepositoryInterface
     */
    protected $clickRepository;
    /**
     * @var BadDomainRepositoryInterface
     */
    protected $badDomainRepository;
    /**
     * @var UuidGeneratorInterface
     */
    protected $uuidGenerator;

    /**
     * Controller constructor.
     * @param ClickRepositoryInterface $clickRepository
     * @param BadDomainRepositoryInterface $badDomainRepository
     * @param UuidGeneratorInterface $uuidGenerator
     */
    public function __construct(ClickRepositoryInterface $clickRepository, BadDomainRepositoryInterface $badDomainRepository, UuidGeneratorInterface $uuidGenerator)
    {
        $this->clickRepository = $clickRepository;
        $this->badDomainRepository = $badDomainRepository;
        $this->uuidGenerator = $uuidGenerator;
    }

    /**
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function index()
    {
        $clicks = $this->clickRepository->findAll();

        return view('welcome', ['clicks' => $clicks]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function click(Request $request)
    {
        try {
            $userAgent = $request->header('User-Agent', '');
            $ip = $request->ip();
            $referer = $request->header('referer', '');
            $param1 = $request->get('param1', '');
            $param2 = $request->get('param2', '');
            $badDomain = 0;

            $clickEntityExist = $this->clickRepository->findOneByData(
                $userAgent,
                $ip,
                $referer,
                $param1
            );

            if ($clickEntityExist) {
                return $this->incrementError($clickEntityExist);
            }

            $newClickEnity = $this->clickRepository->create(
                $this->uuidGenerator->getUuid()->string,
                $userAgent,
                $ip,
                $referer,
                $param1,
                $param2,
                $badDomain
            );

            $badDomainExist = $this->badDomainRepository->findByName($referer);

            if ($badDomainExist) {
                return $this->incrementError($newClickEnity, true, true);
            }

            return redirect()->route('success', [$newClickEnity->getId()]);
        } catch (\Exception $exception) {
            \Log::error($exception->getMessage());
            abort(500);
        }

    }

    /**
     * @param Click $clickEntityExist
     * @param bool $badDomainFlag
     * @param bool $redirect
     * @return \Illuminate\Http\RedirectResponse
     */
    private function incrementError(Click $clickEntityExist, $badDomainFlag = false, $redirect = false)
    {
        $this->clickRepository->incrementError($clickEntityExist);

        if ($badDomainFlag) {
            $this->clickRepository->setBadDomain($clickEntityExist);
        }

        return redirect()->route('error', ['click_id' => $clickEntityExist->getId()])->with(['redirect' => $redirect]);
    }

    /**
     * @param $click_id
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function success($click_id)
    {
        return view('success', ['click_id' => $click_id]);
    }

    /**
     * @param $click_id
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function error($click_id)
    {
        return view('error', ['click_id' => $click_id]);
    }
}
