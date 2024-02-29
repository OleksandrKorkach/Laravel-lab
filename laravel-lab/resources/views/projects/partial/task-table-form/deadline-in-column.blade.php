@if (!empty($task->deadline))
    @php
        $deadline = new DateTime($task->deadline);
        $now = new DateTime();
        $deadlineYear = ($deadline->format('Y') != $now->format('Y')) ? ', Y' : '';

        if ($deadline->format('Y-m-d') === $now->format('Y-m-d')) {
            $formattedDeadline = 'Today, ' . $deadline->format('H:i');
        }
        elseif ($deadline <= $now->modify('+1 week')) {
            $formattedDeadline = $deadline->format('l');
        }
        elseif ($deadline->format('Y') > $now->format('Y')) {
            $formattedDeadline = 'Next year';
        }
        else {
            $formattedDeadline = $deadline->format('F d');
        }
    @endphp
    <div class="text-right">
        {{ $formattedDeadline }}
    </div>
@endif
