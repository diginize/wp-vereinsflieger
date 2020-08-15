<?php


namespace Diginize\WpVereinsflieger\VereinsfliegerApi\Api;


use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

abstract class AbstractApi {

	/** @var string  */
	protected $baseUrl = 'https://www.vereinsflieger.de/interface/rest';

	/** @var string|null  */
	public $accesstoken = null;

	/** @var ClientInterface */
	protected $client;

	/** @var ObjectNormalizer */
	protected $normalizer;

	/** @var Serializer */
	protected $serializer;

	public function __construct(?ClientInterface $client = null) {
		$this->client = new Client();
		$this->normalizer = new ObjectNormalizer(null, new CamelCaseToSnakeCaseNameConverter());
		$this->serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
	}

	public function setBaseUrl(string $baseUrl): void {
		$this->baseUrl = $baseUrl;
	}

	protected function getHttpOptions(array $mergeWith = [], bool $disableAccessToken = false) {
		return array_merge_recursive(
			[
				'http_errors' => false
			],
			$this->accesstoken && !$disableAccessToken ? [
				'query' => ['accesstoken' => $this->accesstoken]
			] : [],
			$mergeWith);
	}

	protected function serializeRequestParams($params): array {
		return json_decode($this->serializer->serialize($this->normalizer->normalize($params), 'json'), JSON_OBJECT_AS_ARRAY);
	}

	protected function deserializeResponse(ResponseInterface $response, string $targetType) {
		return $this->serializer->deserialize($response->getBody()->getContents(), $targetType, 'json');
	}

}