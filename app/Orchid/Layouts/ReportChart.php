<?php

declare(strict_types=1);

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Chart;

class ReportChart extends Chart
{

    /**
     * Height of the chart.
     *
     * @var int
     */
    protected $height = 300;

    /**
     * Configuring line.
     *
     * @var array
     */
    protected $lineOptions = [
        'spline'     => 1,
        'regionFill' => 1,
        'hideDots'   => 0,
        'hideLine'   => 0,
        'heatline'   => 0,
        'dotSize'    => 3,
    ];

    /**
     * To highlight certain values on the Y axis, markers can be set.
     * They will shown as dashed lines on the graph.
     */
    protected function markers(): ?array
    {
        return [
            [
                'label'   => 'Order',
                'value'   => 10,
            ],
        ];
    }

    protected $export = true;

    protected $valuesOverPoints = 5;

    protected $barOptions = [
        'spaceRatio' => 1,
        'stacked'    => 0,
        'height'     => 20,
        'depth'      => 2,
    ];

    protected $colors = [
        '#488511', '#e40000', '#5ab1ef', '#ffb980', '#d87a80',
        '#8d98b3', '#e5cf0d', '#97b552', '#95706d', '#dc69aa',
        '#07a2a4', '#9a7fd1', '#588dd5', '#f5994e', '#c05050',
        '#59678c', '#e40000', '#7eb00a', '#6f5553', '#e40000',
    ];

}
