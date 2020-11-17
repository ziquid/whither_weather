<?php

namespace Drupal\whither_weather\Controller;

use Drupal\Component\Utility\Html;
use Drupal\Core\Controller\ControllerBase;
use GuzzleHttp\Exception\RequestException;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class WeatherController.
 */
class WeatherController extends ControllerBase {

  /**
   * GuzzleHttp\ClientInterface definition.
   *
   * @var \GuzzleHttp\ClientInterface
   */
  protected $httpClient;

  /**
   * API key.
   *
   * @var string
   */
  protected $apiKey;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    $instance = parent::create($container);
    $instance->httpClient = $container->get('http_client');

    $config = $instance->config('whither_weather.config');
    $instance->apiKey = $config->get('api_key');

    return $instance;
  }

  /**
   * Weather Page.
   *
   * @param string $where
   *   Where to search for the weather?
   *
   * @return array
   *   The render array.
   */
  public function weatherPage($where) {

    $where = Html::escape($where);

    try {
      $weatherResponse = $this->httpClient->request('GET',
        'api.openweathermap.org/data/2.5/weather?q=' . $where . '&appid=' . $this->apiKey);
    }
    catch (RequestException $exception) {
      // @FIXME: do some fancy request handling here.
    }

    if (isset($weatherResponse)) {
      $status = $weatherResponse->getStatusCode();
      if ($status != 200) {
        // @FIXME: handle status code error.
      }
      else {
        $weatherJson = (string) $weatherResponse->getBody()->getContents();
        $weatherData = json_decode($weatherJson, TRUE);
        // @FIXME: check for json_last_error() !== JSON_ERROR_NONE.
      }
    }

    ksm($weatherData);

    return [
      '#theme' => 'whither_weather_page',
      '#weather' => $weatherData,
    ];
  }

}
