import { Component, Input, OnInit } from '@angular/core';
import { GraficoModel } from 'src/app/model/GraficoModel';

@Component({
  selector: 'app-grafico-barras',
  templateUrl: './grafico-barras.component.html',
  styleUrls: ['./grafico-barras.component.scss']
})
export class GraficoBarrasComponent implements OnInit {

  @Input() List: Array<GraficoModel>;

  public Total=0;
  public MaxHeight= 160;

  constructor() {
    this.List = new Array<GraficoModel>();
  }

  ngOnInit(): void {
    this.MontarGrafico();
  }

  MontarGrafico(){
    this.List.forEach(element => {
      this.Total += element.Value;
    });

    this.List.forEach(element => {
      element.Size = Math.round((element.Value*this.MaxHeight)/this.Total) + '%';
    });
  }

}
