import {Component, EventEmitter, Input, OnInit, Output} from '@angular/core';
import {Router} from '@angular/router';
import {Vacation} from '../types';

@Component({
  selector: 'app-vacation-data-form',
  templateUrl: './vacation-data-form.component.html',
  styleUrls: ['./vacation-data-form.component.css']
})
export class VacationDataFormComponent {

  @Input() buttonText: any;
  @Input() currentCity: any = '';
  @Input() currentCountry: any = '';
  @Input() currentDescription: any = '';
  @Input() currentTargets: any = '';
  @Input() currentCost: any = '';

  city: string | any = '';
  country: string | any = '';
  description: string | any = '';
  targets: string | any = '';
  cost: string | any = '';

  // tslint:disable-next-line:no-output-on-prefix
  @Output() onSubmit: any = new EventEmitter<Vacation>();

  constructor(
    private router: Router,
  ) { }

  // tslint:disable-next-line:use-lifecycle-interface
  ngOnInit(): void {
    this.city = this.currentCity;
    this.country = this.currentCountry;
    this.description = this.currentDescription;
    this.targets = this.currentTargets;
    this.cost = this.currentCost;
  }

  onButtonClicked(): void {
    this.onSubmit.emit({
      id: null,
      city: this.city,
      country: this.country,
      description: this.description,
      targets: this.targets,
      cost: this.cost,
    });
  }
}
