<?php declare(strict_types=1);

namespace PHPUGDD\BusinessMetrics\ForStarters;

use OpenMetricsPhp\Exposition\Text\Collections\CounterCollection;
use OpenMetricsPhp\Exposition\Text\Collections\GaugeCollection;
use OpenMetricsPhp\Exposition\Text\HttpResponse;
use OpenMetricsPhp\Exposition\Text\Metrics\Counter;
use OpenMetricsPhp\Exposition\Text\Metrics\Gauge;
use OpenMetricsPhp\Exposition\Text\Types\Label;
use OpenMetricsPhp\Exposition\Text\Types\MetricName;
use Throwable;
use function random_int;

require_once dirname( __DIR__ ) . '/vendor/autoload.php';

try
{
	$counters = CounterCollection::fromCounters(
		MetricName::fromString( 'online_since' ),
		Counter::fromValue( time() - 1551205367 )
		       ->withLabels(
			       Label::fromNameAndValue( 'appName', 'business_metrics_for_starters' )
		       )
	)->withHelp( 'Since when is this application online.' );

	$gauges = GaugeCollection::fromGauges(
		MetricName::fromString( 'stocks' ),
		Gauge::fromValue( (float)random_int( 30, 50 ) )->withLabels(
			Label::fromNameAndValue( 'tenant', 'attandees' )
		),
		Gauge::fromValue( (float)random_int( 35, 40 ) )->withLabels(
			Label::fromNameAndValue( 'tenant', 'members' )
		),
		Gauge::fromValue( (float)random_int( 10, 50 ) )->withLabels(
			Label::fromNameAndValue( 'tenant', 'fridge' )
		)
	);

	HttpResponse::fromMetricCollections( $counters, $gauges )
	            ->withHeader( 'Content-Type', 'text/plain; charset=utf-8' )
	            ->respond();
}
catch ( Throwable $e )
{
	echo "W000psie!\n{$e->getMessage()}\n{$e->getTraceAsString()}";
}

