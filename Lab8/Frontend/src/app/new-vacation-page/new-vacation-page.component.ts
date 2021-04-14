import { Component, OnInit } from '@angular/core';
import {Router} from '@angular/router';
import {VacationsService} from '../vacations.service';

@Component({
  selector: 'app-new-vacation-page',
  templateUrl: './new-vacation-page.component.html',
  styleUrls: ['./new-vacation-page.component.css']
})
export class NewVacationPageComponent implements OnInit {


  constructor(
    private router: Router,
    private vacationsService: VacationsService,
  ) { }

  ngOnInit(): void {
  }

  // @ts-ignore
  onSubmit({city, country, description, targets, cost}): void {
    this.vacationsService.createVacation(city, country, description, targets, cost)
      .subscribe( () => {
        this.router.navigateByUrl('/my-vacations');
      });
  }

}
