<?php

namespace Tests\Feature;

use App\Entities\BadDomain;
use App\Entities\Click;
use App\Interfaces\Uuid\UuidGeneratorInterface;
use Doctrine\ORM\EntityManager;
use Tests\TestCase;

class ClickTest extends TestCase
{
    protected const CLASS_NAME_CLICK = Click::class;

    public function testMainPage()
    {
        $response = $this->get('/');
        $response->assertViewIs('welcome');
        $response->assertSuccessful();
    }


    public function testSuccessErrorClick()
    {
        $param1 = rand();
        $param2 = rand();
        $em = app(EntityManager::class);

        $response = $this->get('/click?param1=' . $param1 . '&param2=' . $param2);

        $newClickEnity = $em->getRepository(self::CLASS_NAME_CLICK)->findOneBy([
            'param1' => $param1,
            'param2' => $param2,
        ]);

        $response->assertRedirect(\route('success', $newClickEnity->getId()));
        $response->assertStatus(302);


        $response = $this->get('/click?param1=' . $param1 . '&param2=' . $param2);
        $response->assertRedirect(\route('error', $newClickEnity->getId()));
        $response->assertStatus(302);
        $response->assertSessionHasAll(['redirect' => false]);
    }

    public function testBadDomainClick()
    {
        $badDomdainExample = 'https://' . rand() . 'xxx.com/';

        $uuidGenerator = app(UuidGeneratorInterface::class);
        $uuid = $uuidGenerator->getUuid();

        $em = app(EntityManager::class);
        $clickEnity = new BadDomain($uuid->string, $badDomdainExample);
        $em->persist($clickEnity);
        $em->flush();

        $param1 = rand();
        $param2 = rand();

        $response = $this->get('/click?param1=' . $param1 . '&param2=' . $param2, ['HTTP_REFERER' => $badDomdainExample]);

        $newClickEnity = $em->getRepository(self::CLASS_NAME_CLICK)->findOneBy([
            'param1' => $param1,
            'param2' => $param2,
        ]);

        $response->assertRedirect(\route('error', $newClickEnity->getId()));
        $response->assertStatus(302);
        $response->assertSessionHasAll(['redirect' => true]);
    }
}
