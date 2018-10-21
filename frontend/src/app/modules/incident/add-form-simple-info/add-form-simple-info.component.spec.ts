import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AddFormSimpleInfoComponent } from './add-form-simple-info.component';

describe('AddFormSimpleInfoComponent', () => {
  let component: AddFormSimpleInfoComponent;
  let fixture: ComponentFixture<AddFormSimpleInfoComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AddFormSimpleInfoComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AddFormSimpleInfoComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
