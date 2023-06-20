import json
from time import sleep

import requests
from requests.models import Response
from serial import Serial

ser = Serial('COM2', 9600)  # baudrate

print('Serial port is open: ' + str(ser.is_open))
while True:
    print('Waiting for data...')
    data = str(ser.readline())[2:-5]
    print('Data received: ' + data)
    if data == '':
        print('No data')
        continue
    data = json.loads(data)

    response: Response = requests.post(
        'http://localhost:80/Supervision/api/SensorTag/create.php', json=data)
    print(response.status_code)
    print(response.text)
    sleep(0.5)
