import { ComponentFixture, TestBed } from '@angular/core/testing';

import { MyVacationsPageComponent } from './my-vacations-page.component';

describe('MyVacationsPageComponent', () => {
  let component: MyVacationsPageComponent;
  let fixture: ComponentFixture<MyVacationsPageComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ MyVacationsPageComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(MyVacationsPageComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
