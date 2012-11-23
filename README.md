web_service
===========

This project will be divided into three parts. The first encompassing the design of a web service which will retrieve data from a room sensor. The room sensor will record temperature and humidity data and send it at regular intervals to the web service. 

The second part of the project will consist of the wiring up of the room sensor to the electric heater so that it can be controlled. This will be achieved using either a digitally controlled relay or if the heater permits a simple digital switch to turn the heater on and off.

The final part of the project will consist of programming the logic behind the intelligent room thermostat.

Sprint 1 - 17 November 2012
1. Web Service
    Receive sensor readings
    Store Sensor Readings

2. Database
    Create tables
    Create data views

3. Hardware Code
    Code sensor reading
    HTTP data communication

Sprint 2 - 24 November 2012
1. Basic data display - print table
     (Sprint 3) Advanced - Display Graph

2. Rapid Fluctuation Detection (RFD)
    - Take average for last ten measurments
    - Calculate 10% increase on this average $10increase
    - Calculate 10% decrease on this average $10decrease
    - If $10increase, light red LED and print to website
    - If $10decrease, light blue LED and print to website

3. Remove 