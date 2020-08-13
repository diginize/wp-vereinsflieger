<?php


namespace Diginize\WpVereinsflieger\VereinsfliegerApi\Api;


use GuzzleHttp\Client;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class AbstractApi {

	/** @var Client */
	protected $gruzzle;

	/** @var Serializer */
	protected $serializer;

	public function __construct() {
		$this->gruzzle = new Client();
		$this->serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
	}

	protected function deserializeResponse(string $responseBody, $targetType) {
		$this->serializer->deserialize($responseBody, $targetType, 'json', [
			AbstractNormalizer::ALLOW_EXTRA_ATTRIBUTES => false
		]);
	}

}