<?php
/**
 * Trait JsonResponses
 *
 * @author Del
 */

namespace Delatbabel\JsonResponses;

use Illuminate\Http\Response as IlluminateResponse;
use Illuminate\Http\JsonResponse;

/**
 * Trait JsonResponses
 *
 * Composition of response, result, message and data.  Defines some shortcut
 * functions to send back responses of various kinds.
 *
 * It can be added as a trait anywhere in your application, but in a controller
 * or route handling class would be the most obvious place.
 *
 * ### Examples
 *
 * #### Success Response With Data
 *
 * <code>
 * return $this->respondSuccess('OK', ['time' => gmtime()]);
 * </code>
 *
 * #### Failure Response
 *
 * <code>
 * return $this->respondInternalError();
 * </code>
 *
 * #### Failure Response With Message and Data
 *
 * <code>
 * return $this->respondNotAcceptable(
 *     'Mugwumps are not found in swamps',
 *     ['location' => 'desert']);
 * </code>
 */
trait JsonResponses
{
    /**
     * @var int
     */
    protected $responseCode = IlluminateResponse::HTTP_OK;

    /**
     * Get the response code
     *
     * @return int
     */
    public function getResponseCode()
    {
        return $this->responseCode;
    }

    /**
     * Set a response code e.g. 200 - success, 404 - page not found, 500 - internal server error, etc.
     *
     * @param $responseCode
     * @return JsonResponses provides a fluent interface.
     */
    public function setResponseCode($responseCode = IlluminateResponse::HTTP_OK)
    {
        $this->responseCode = $responseCode;

        return $this;
    }

    //
    // SUCCESS RESPONSES, 200+
    //

    /**
     * Set a response code to 200 and a response message
     *
     * @param string $message
     * @param array $data
     * @return array
     */
    public function respondSuccess($message = 'OK', $data = [])
    {
        return $this->respondMessage(true, $message, $data);
    }

    /**
     * Set a response code to 201 and a response message
     *
     * @param string $message
     * @param array $data
     * @return array
     */
    public function respondCreated($message = 'Created', $data = [])
    {
        return $this->setResponseCode(IlluminateResponse::HTTP_CREATED)
            ->respondMessage(true, $message, $data);
    }

    /**
     * Set a response code to 202 and a response message
     *
     * @param string $message
     * @param array $data
     * @return array
     */
    public function respondAccepted($message = 'Accepted', $data = [])
    {
        return $this->setResponseCode(IlluminateResponse::HTTP_ACCEPTED)
            ->respondMessage(true, $message, $data);
    }

    //
    // CLIENT ERROR RESPONSES, 400+
    //

    /**
     * Set a response code to 400 and a response message
     *
     * @param string $message
     * @param array $data
     * @return array
     */
    public function respondBadRequest($message = 'Bad Request!', $data = [])
    {
        return $this->setResponseCode(IlluminateResponse::HTTP_BAD_REQUEST)
            ->respondMessage(false, $message, $data);
    }

    /**
     * Set a response code to 401 and a response message
     *
     * @param string $message
     * @param array $data
     * @return array
     */
    public function respondUnauthorized($message = 'Unauthorized!', $data = [])
    {
        return $this->setResponseCode(IlluminateResponse::HTTP_UNAUTHORIZED)
            ->respondMessage(false, $message, $data);
    }

    /**
     * Set a response code to 403 and a response message
     *
     * @param string $message
     * @param array $data
     * @return array
     */
    public function respondForbidden($message = 'Forbidden!', $data = [])
    {
        return $this->setResponseCode(IlluminateResponse::HTTP_FORBIDDEN)
            ->respondMessage(false, $message, $data);
    }

    /**
     * Set a response code to 404 and a response message
     *
     * @param string $message
     * @param array $data
     * @return array
     */
    public function respondNotFound($message = 'Not Found!', $data = [])
    {
        return $this->setResponseCode(IlluminateResponse::HTTP_NOT_FOUND)
            ->respondMessage(false, $message, $data);
    }

    /**
     * Set a response code to 406 and a response message
     *
     * @param string $message
     * @param array $data
     * @return array
     */
    public function respondNotAcceptable($message = 'Not Acceptable!', $data = [])
    {
        return $this->setResponseCode(IlluminateResponse::HTTP_NOT_ACCEPTABLE)
            ->respondMessage(false, $message, $data);
    }

    //
    // SERVER ERROR RESPONSES, 500+
    //

    /**
     * Set a response code to 500 and a response message
     *
     * @param string $message
     * @param array $data
     * @return array
     */
    public function respondInternalError($message = 'Internal Error!', $data = [])
    {
        return $this->setResponseCode(IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR)
            ->respondMessage(false, $message, $data);
    }

    /**
     * Set a response code to 501 and a response message
     *
     * @param string $message
     * @param array $data
     * @return array
     */
    public function respondNotImplemented($message = 'Not Implemented!', $data = [])
    {
        return $this->setResponseCode(IlluminateResponse::HTTP_NOT_IMPLEMENTED)
            ->respondMessage(false, $message, $data);
    }

    //
    // GENERIC RESPONSES
    //

    /**
     * Set a response message
     *
     * @param $boolean
     * @param $message
     * @param $data
     * @return array
     */
    public function respondMessage($boolean, $message, $data = [])
    {
        return $this->respond([
            'response' => [
                'success'       => $boolean,
                'message'       => $message,
                'response_code' => $this->getResponseCode()
            ],
            'data' => $data
        ]);
    }

    /**
     * Compose the response by setting the header and messages
     *
     * @param $data
     * @param array $headers
     * @return IlluminateResponse
     */
    public function respond($data, $headers = [])
    {
        return new JsonResponse($data, $this->getResponseCode(), $headers);
    }
}
