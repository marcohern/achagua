import { Component, OnInit } from '@angular/core';
import { Incident } from '../incident';
import { IncidentsService } from '../incidents.service';


@Component({
  selector: 'incident-add-form',
  templateUrl: './add-form.component.html',
  styleUrls: ['./add-form.component.css']
})
export class AddFormComponent implements OnInit {

  constructor(private is:IncidentsService) { }

  onSaving($incident) {

    console.log("onSaving", $incident);

    var inc:Incident = {
      vbg: $incident.vbg,
      event_date: new Date($incident.year,1,1),
      lat: 0,
      lng: 0,
      country_id: 57,
      state_id: $incident.state_id,
      city_id: $incident.city_id,
      justice: $incident.justice
    };

    this.is.create(inc);
  }

  ngOnInit() {
    
  }
}
