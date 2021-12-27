# Trackable events for the control dispatching process
You can track the lifecycle of events (in my project it uses for logging the event bus)

## Example of uses
- Create the event and implement `TrackableEvent` interface
- Create listener for handle `EventDispatching` event
- Register listener in EventServiceProvider
- Dispatch event
- profit