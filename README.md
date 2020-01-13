# RSVP project

## General information
- Docker environment based: Docker4Drupal
- Drupal version: 8
- Drupal Theme: Bootstrap Barrio
- Front-end dependency manager: npm 
- Front-end compiler: gulp  

The project consists in a RSVP application. Only logged users can to register on the available events.

The RSVP feature is an Ajax submission that to create automatically a RSVP entity, storing the user and event reference to list on the report page. 

### Structure

Content Types:
- Event: All information about local events.

Module RSVP:
- RSVP Entity: Storage user subscription about an event.
- RSVP Blocks: Block used to create the register process.
- RSVP Ajax callback: used to create a new RSVP entity when the button 'Register' is pressed.
- RSVP Homepage: used to create the homepage link of the aplication.

## Local Setup

Clone the repository and run it:

```
make install
```