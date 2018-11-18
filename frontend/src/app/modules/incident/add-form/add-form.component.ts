import { Component, OnInit, TemplateRef } from '@angular/core';
import { Incident } from '../incident';
import { IncidentsService } from '../incidents.service';
import { BsModalService, BsModalRef, ModalOptions } from 'ngx-bootstrap/modal';
import { ModalComponent } from '../modal/modal.component';


@Component({
  selector: 'incident-add-form',
  templateUrl: './add-form.component.html',
  styleUrls: ['./add-form.component.css']
})
export class AddFormComponent implements OnInit {

  modalRef:BsModalRef;

  constructor(private is:IncidentsService, private bs:BsModalService) { }

  onSaving($event) {

    console.log("onSaving", $event);
    var $incident = $event.value;

    var inc:Incident = {
      vbg: $incident.vbg,
      event_date: '' + $incident.year + '-01-01',
      lat: 0,
      lng: 0,
      country_id: 57,
      state_id: parseInt($incident.state),
      city_id: parseInt($incident.city),
      justice: $incident.justice
    };

    this.is.create(inc).subscribe(result => {
      console.log(result);

      const initialState = {
        list: [
          "Este dialogo confirma que se ha registrado el incidente satisfactoriamente.",
          "Puede cerrar este dialogo registrar otro incidente nuevamente.",
          "Identidad del registro: " + result.id,
      ],
        title:"Incidente guardado # " + result.id
      };
      
      this.modalRef = this.bs.show(ModalComponent, {initialState});
      this.modalRef.content.closeBtnName = 'Cerrar';
    }, error => {
      console.error(error);
    });
  }

  ngOnInit() {
    
  }
}
