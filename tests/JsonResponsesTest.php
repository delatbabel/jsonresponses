<?php

use Illuminate\Http\JsonResponse;
use Delatbabel\JsonResponses\DummyClass;

/**
 * Class JsonResponsesTest
 *
 * Test case for JsonResponses
 */
class JsonResponsesTest extends PHPUnit_Framework_TestCase
{
    /** @var DummyClass */
    protected $controller;

    protected function setUp()
    {
        parent::setUp();

        $this->controller = new DummyClass();
    }

    public function testSetAndGetResponseCode()
    {
        $this->controller->setResponseCode(666);
        $this->assertEquals(666, $this->controller->getResponseCode());
    }

    public function testSuccess()
    {
        $response = $this->controller->respondSuccess('OK', ['hello' => 'world']);
        $this->assertTrue($response instanceof JsonResponse);
        $data = $response->getData();
        $this->assertTrue($data instanceof stdClass);
        $this->assertTrue($data->response->success);
        $this->assertSame(200, $data->response->response_code);
        $this->assertSame('OK', $data->response->message);
        $this->assertSame('world', $data->data->hello);
    }

    public function testCreated()
    {
        $response = $this->controller->respondCreated();
        $this->assertTrue($response instanceof JsonResponse);
        $data = $response->getData();
        $this->assertTrue($data instanceof stdClass);
        $this->assertTrue($data->response->success);
        $this->assertSame(201, $data->response->response_code);
    }

    public function testAccepted()
    {
        $response = $this->controller->respondAccepted();
        $this->assertTrue($response instanceof JsonResponse);
        $data = $response->getData();
        $this->assertTrue($data instanceof stdClass);
        $this->assertTrue($data->response->success);
        $this->assertSame(202, $data->response->response_code);
    }

    // --- Fail tests

    public function testBadRequest()
    {
        $response = $this->controller->respondBadRequest();
        $this->assertTrue($response instanceof JsonResponse);
        $data = $response->getData();
        $this->assertTrue($data instanceof stdClass);
        $this->assertFalse($data->response->success);
        $this->assertSame(400, $data->response->response_code);
    }

    public function testUnauthorized()
    {
        $response = $this->controller->respondUnauthorized();
        $this->assertTrue($response instanceof JsonResponse);
        $data = $response->getData();
        $this->assertTrue($data instanceof stdClass);
        $this->assertFalse($data->response->success);
        $this->assertSame(401, $data->response->response_code);
    }

    public function testForbidden()
    {
        $response = $this->controller->respondForbidden();
        $this->assertTrue($response instanceof JsonResponse);
        $data = $response->getData();
        $this->assertTrue($data instanceof stdClass);
        $this->assertFalse($data->response->success);
        $this->assertSame(403, $data->response->response_code);
    }

    public function testNotFound()
    {
        $response = $this->controller->respondNotFound();
        $this->assertTrue($response instanceof JsonResponse);
        $data = $response->getData();
        $this->assertTrue($data instanceof stdClass);
        $this->assertFalse($data->response->success);
        $this->assertSame(404, $data->response->response_code);
    }

    public function testNotAcceptable()
    {
        $response = $this->controller->respondNotAcceptable();
        $this->assertTrue($response instanceof JsonResponse);
        $data = $response->getData();
        $this->assertTrue($data instanceof stdClass);
        $this->assertFalse($data->response->success);
        $this->assertSame(406, $data->response->response_code);
    }

    public function testUnprocessableEntity()
    {
        $response = $this->controller->respondUnprocessableEntity();
        $this->assertTrue($response instanceof JsonResponse);
        $data = $response->getData();
        $this->assertTrue($data instanceof stdClass);
        $this->assertFalse($data->response->success);
        $this->assertSame(422, $data->response->response_code);
    }

    public function testInternalError()
    {
        $response = $this->controller->respondInternalError();
        $this->assertTrue($response instanceof JsonResponse);
        $data = $response->getData();
        $this->assertTrue($data instanceof stdClass);
        $this->assertFalse($data->response->success);
        $this->assertSame(500, $data->response->response_code);
    }

    public function testNotImplemented()
    {
        $response = $this->controller->respondNotImplemented();
        $this->assertTrue($response instanceof JsonResponse);
        $data = $response->getData();
        $this->assertTrue($data instanceof stdClass);
        $this->assertFalse($data->response->success);
        $this->assertSame(501, $data->response->response_code);
    }
}
