import { Component, OnInit } from '@angular/core';
import { BsModalRef } from 'ngx-bootstrap/modal';

@Component({
  selector: 'modal',
  templateUrl: './modal.component.html',
  styleUrls: ['./modal.component.css']
})
export class ModalComponent implements OnInit {

  title: string;
  closeBtnName: string;
  list: any[] = [];
 

  constructor(public bsModalRef: BsModalRef) { }

  ngOnInit() {
    
  }

}
