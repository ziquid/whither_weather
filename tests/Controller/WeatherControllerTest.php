<?php

namespace Drupal\whither_weather\Tests;

use Drupal\simpletest\WebTestBase;
use GuzzleHttp\ClientInterface;

/**
 * Provides automated tests for the whither_weather module.
 */
class WeatherControllerTest extends WebTestBase {

  /**
   * GuzzleHttp\ClientInterface definition.
   *
   * @var \GuzzleHttp\ClientInterface
   */
  protected $httpClient;


  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return [
      'name' => "whither_weather WeatherController's controller functionality",
      'description' => 'Test Unit for module whither_weather and controller WeatherController.',
      'group' => 'Other',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();
  }

  /**
   * Tests whither_weather functionality.
   */
  public function testWeatherController() {
    // Check that the basic functions of module whither_weather.
    $this->assertEquals(TRUE, TRUE, 'Test Unit Generated via Drupal Console.');
  }

}
