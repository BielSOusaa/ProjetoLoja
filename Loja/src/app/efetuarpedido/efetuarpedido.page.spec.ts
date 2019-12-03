import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { EfetuarpedidoPage } from './efetuarpedido.page';

describe('EfetuarpedidoPage', () => {
  let component: EfetuarpedidoPage;
  let fixture: ComponentFixture<EfetuarpedidoPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ EfetuarpedidoPage ],
      imports: [IonicModule.forRoot()]
    }).compileComponents();

    fixture = TestBed.createComponent(EfetuarpedidoPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
