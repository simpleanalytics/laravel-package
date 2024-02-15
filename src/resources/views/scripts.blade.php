@if ($enabled)
    <!-- SimpleAnalytics -->
    <script {!!$settings!!} async defer src="https://{{$domain}}/latest.js"></script>

    @if ($auto_events)
        <script {!!$settings_events!!} async src="https://scripts.simpleanalyticscdn.com/auto-events.js"></script>
    @endif
    <noscript><img src="https://queue.simpleanalyticscdn.com/noscript.gif" alt="NoScript" referrerpolicy="no-referrer-when-downgrade" /></noscript>
@endif


