import { ComponentFixture, TestBed } from '@angular/core/testing';

import { EditVacationPageComponent } from './edit-vacation-page.component';

describe('EditVacationPageComponent', () => {
  let component: EditVacationPageComponent;
  let fixture: ComponentFixture<EditVacationPageComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ EditVacationPageComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(EditVacationPageComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
