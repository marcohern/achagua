import { IncidentModule } from './incident.module';

describe('IncidentModule', () => {
  let incidentModule: IncidentModule;

  beforeEach(() => {
    incidentModule = new IncidentModule();
  });

  it('should create an instance', () => {
    expect(incidentModule).toBeTruthy();
  });
});
