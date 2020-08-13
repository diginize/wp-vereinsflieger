<?php


namespace Diginize\WpVereinsflieger\VereinsfliegerApi\Api;


use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

abstract class AbstractApi {

	protected $baseUrl = 'https://www.vereinsflieger.de/interface/rest';

	/** @var ClientInterface */
	protected $client;

	/** @var Serializer */
	protected $serializer;

	public function __construct(?ClientInterface $client = null) {
		$this->client = new Client();
		$this->serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
	}

	protected function serializeRequestParams($params): array {
		return json_encode($this->serializer->serialize($params, 'json'), JSON_OBJECT_AS_ARRAY);
	}

	protected function deserializeResponse(string $responseBody, $targetType) {
		return $this->serializer->deserialize($responseBody, $targetType, 'json', [
			AbstractNormalizer::ALLOW_EXTRA_ATTRIBUTES => false
		]);
	}

}