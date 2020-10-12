# OMS External Processor for Payone
[![Build Status](https://travis-ci.org/fond-of/spryker-oms-external-processor-payone.svg?branch=master)](https://travis-ci.org/fond-of/spryker-oms-external-processor-payone)
[![PHP from Travis config](https://img.shields.io/travis/php-v/fond-of/spryker-oms-external-processor-payone.svg)](https://php.net/)
[![license](https://img.shields.io/github/license/fond-of/spryker-oms-external-processor-payone.svg)](https://packagist.org/packages/fond-of-spryker/oms-external-processor-payone)

Plugin for the external processor module: https://packagist.org/packages/fond-of-spryker/oms-external-processor
Wait for the order that all items are captured and then process at once instead of sending or exporting a splitted order.

## Installation

```
composer require fond-of-spryker/oms-external-processor-payone
```

## Configuration

Extend in PYZ the OmsExternalProcessorDependencyProvider

```
/**
 * @return \FondOfSpryker\Zed\OmsExternalProcessor\Dependency\Plugin\ExternalProcessorPluginInterface[]
 */
protected function getExternalProcessorPlugins(): array
{
    return [
        new PayoneCaptureCheckExternalProcessorPlugin()
    ];
}
```

Remove or set the `on enter` event in the oms configuration to false
```
<event name="send-order-confirmation" manual="false" onEnter="false" command="OrderConfirmationBcc/SendOrderConfirmationWithBccPlugin"/>
```
```
<transition happy="true">
                <source>captured</source>
                <target>order-confirmation sent</target>
                <event>send-order-confirmation</event>
            </transition>
```
By default, it processes only orders in state `captured` and move / throws event `send order confirmation`. You can change those via config.
```
$config[\FondOfSpryker\Shared\OmsExternalProcessorPayone\OmsExternalProcessorPayoneConstants::EVENT_NAME] = 'send order confirmation';
$config[\FondOfSpryker\Shared\OmsExternalProcessorPayone\OmsExternalProcessorPayoneConstants::CAPTURED_STATE_NAME] = 'captured';
$config[\FondOfSpryker\Shared\OmsExternalProcessorPayone\OmsExternalProcessorPayoneConstants::MAX_AGE_IN_DAYS] = 7;
```

## Usage

Run 'vendor/bin/console oms:external:process -r PayoneCaptureCheckExternalProcessorPlugin' or create job
